set[:image_wrapper][:yii_version] = '1.1.13'

default[:image_wrapper][:app_user] = 'image_wrapper'
default[:image_wrapper][:db][:database] = 'image_wrapper'
default[:image_wrapper][:db][:host] = 'localhost'
default[:image_wrapper][:db][:user] = 'image_wrapper'

default[:image_wrapper][:python][:virtualenv] = '/home/image_wrapper/python-env'
default[:image_wrapper][:python][:build_dir] = '/home/image_wrapper/build'
set[:image_wrapper][:python][:schemup][:version] = '5f5d35f5c7e9708e62ca43aa4743610e2cb696ae'

default[:image_wrapper][:environment] = 'dev' # 'dev' or 'production'

default[:image_wrapper][:ssl] = nil
