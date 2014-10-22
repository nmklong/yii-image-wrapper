<?php

class ImageHaver extends CActiveRecord {

    #public $size = 700;
    public $thumbSize = 120;
    public $mediumSize = 200;

    const SIZE_ORIGINAL = 'original';
    const SIZE_THUMB = 'thumb';
    const SIZE_MEDIUM = 'medium';
    const SIZE_CROP = 'crop';

    public function createDirs($type) {
        $dir = Yii::getPathOfAlias('imageUploadPath') . "/{$type}";
        #$dir_thumbs = "$dir/thumbs";
        #$dir_small_thumbs = "$dir/small_thumbs";
        if (!file_exists($dir)) mkdir($dir);
        #if (!file_exists($dir_thumbs)) mkdir($dir_thumbs);
        #if (!file_exists($dir_small_thumbs)) mkdir($dir_small_thumbs);
    }

    # Path to file without leading directory or URL
    public function getPath($type, $size='') {
        $class = get_class($this);
        $dir = "/$type";

        if(!empty($size)) $size = "_$size";
        $path = "$dir/{$this->filename}{$size}.png";
        return $path;
    }

    public function setFileName() {
        $this->filename = Utils::getGUID("_") . "_" . uniqid();
    }

    public function getFullPath($type, $size="") {
        return Yii::getPathOfAlias('imageUploadPath') . $this->getPath($type, $size);
    }

    public function getUrl($type, $size="") {
        return Yii::app()->request->baseURL . Yii::getPathOfAlias('imageUploadURL') . $this->getPath($type, $size);
    }

    public function image($type , $size="" , $default_path = null, $return_exists = false) {
        $path = $this->getFullPath($type , $size);
        if (!file_exists($path)) {
            if(!$return_exists) return $default_path;
            else return false;
        }
        return $this->getUrl($type , $size);
    }

    public function getCropped() {
        $type = $this->model_name;
        $cropPath = $this->getFullPath($type, $this::SIZE_CROP);
        if (!file_exists($cropPath)) return $this->image();
        return $this->getUrl($type , $this::SIZE_CROP);
    }

    public function getMedium() {
        $type = $this->model_name;
        $cropPath = $this->getFullPath($type, $this::SIZE_MEDIUM);
        if (!file_exists($cropPath)) return $this->image();
        return $this->getUrl($type , $this::SIZE_MEDIUM);
    }

    public function getCroppedThumb() {
        $type = $this->model_name;
        $thumbPath = $this->getFullPath($type, $this::SIZE_THUMB);
        if (!file_exists($thumbPath)) return $this->thumb();
        return $this->getUrl($type , $this::SIZE_THUMB);
    }

    public function thumb($type , $default_path = null) {
        $path = $this->getFullPath($type, 'thumb');
        if (!file_exists($path))
            return ($default_path) ? $default_path : Util::DEFAULT_USER_PHOTO;
        return $this->getUrl($type, 'thumb');
    }

    public function setImage($type, $image) {
        $this->setFileName();
        $path = $this->getFullPath($type);
        $thumbPath = $this->getFullPath($type, $this::SIZE_THUMB);
        $mediumPath = $this->getFullPath($type, $this::SIZE_MEDIUM);

        if ($image->getSize() > 0) {
            Yii::log(__FUNCTION__."> attempting to store image : $path",'debug');
            $this->createDirs($type);
            if (!$image->saveAs($path)) {
                Yii::log("Could not save file to path: $path", 'error');
                return false;
            }

            $this->transformImage($path, $thumbPath, $this->thumbSize, null);
            $this->transformImage($path, $mediumPath, $this->mediumSize, null);
        } else {
            if (file_exists($path)) return unlink($path);
            else return true;
        }
    }

    # Generate new thumbnails from existing image
    public function resizeImages($type) {
        $path = $this->getFullPath($type);
        $thumbPath = $this->getFullPath($type, 'thumb');
        $smallThumbPath = $this->getFullPath($type, 'small_thumb');
        $this->createDirs($type);

        if (file_exists($path)) {
            Yii::log(__FUNCTION__.'> Resizing image: ' . $path, 'debug');
            $this->transformImage($path, $thumbPath, $this->thumbSize, null);
            $this->transformImage($path, $smallThumbPath, $this->smallThumbSize, null);
        }
    }

    public function imageChooserField($type) {
      $image = $this->image($type);
      if ($image !== null) {
        ?>
          <table>
            <tr>
              <td width="30"><?=CHtml::radioButton("use_$type", true, array('value'=>'current'))?></td>
              <td>Keep <a href="<?= $image ?>">current</a></td>
            </tr>
            <tr>
              <td width="30"><?=CHtml::radioButton("use_$type", false, array('value'=>''))?></td>
              <td><?=CHtml::fileField("{$type}_image")?></td>
            </tr>
          </table>
        <?php
          } else {
        echo CHtml::fileField("{$type}_image");
      }
    }

    public function updateImage($type) {
        $image = CUploadedFile::getInstanceByName($type . "_image");
        if(!$image) {
            $image = CUploadedFile::getInstanceByName('Filedata');
        }

        if ($image) {
            $this->setImage($type, $image);
        }
    }

    public function imageTag($size='',$type=null, $alt='') {
        if(!$type) $type = $this->model_name;
        $url = null;
        switch($size) {
        case '':
            $url = $this->image($type);
            break;
        case 'thumb':
        case 'medium':
            $url = $this->$size($type);
            break;
        default:
            break;
        }
        return CHtml::image($url , $alt);
    }

    public function transformImage($fromPath, $toPath, $width, $height) {
        $image = Yii::app()->image->load($fromPath);

        if ($image) {
            $image->resize($width, $height);
            #Yii::log("From path: $fromPath", "error");
            #Yii::log("Saving to path: $toPath", "error");
            $image->save($toPath);
        }
    }

    public function crop($crop_data) {
        $type = $this->type;
        $path = $this->getFullPath($type);
        $thumbPath = $this->getFullPath($type, $this::SIZE_THUMB);
        $mediumPath = $this->getFullPath($type, $this::SIZE_MEDIUM);
        $cropPath = $this->getFullPath($type, $this::SIZE_CROP);
        $image = Yii::app()->image->load($path);

        if ($image) {
            $image->crop(floatval($crop_data['w']), floatval($crop_data['h']), floatval($crop_data['y']), floatval($crop_data['x']));
            $image->save($cropPath);
            $this->transformImage($cropPath, $thumbPath, $this->thumbSize, null);
            $this->transformImage($cropPath, $mediumPath, $this->mediumSize, null);
        } else {
            if (file_exists($path)) return unlink($path);
            else return true;
        }
    }

    public function deleteImages($type) {
        $image_paths = array(
            $this->getFullPath($type),
            $this->getFullPath($type, $this::SIZE_CROP),
            $this->getFullPath($type, $this::SIZE_THUMB),
            $this->getFullPath($type, $this::SIZE_MEDIUM),
        );

        foreach($image_paths as $path) {
            if(file_exists($path)) unlink($path);
        }
    }
}
