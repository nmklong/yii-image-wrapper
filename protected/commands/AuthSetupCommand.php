<?

class AuthSetupCommand extends CConsoleCommand {
    public function getHelp() {
        return 'Usage: authsetup';
    }

    public function run($args) {
        Yii::log('Running command authsetup', 'debug');

        $connection = Yii::app()->db;

        Yii::log('Clearing out old auth data', 'debug');
        $query = <<<EO_SQL
DELETE FROM "AuthItem";
EO_SQL;
        $command = $connection->createCommand($query);
        $command->execute();

        $query = <<<EO_SQL
DELETE FROM "AuthItemChild";
EO_SQL;
        $command = $connection->createCommand($query);
        $command->execute();

        # For more information about authorization item, visit Yii's tutorial:
        # http://www.yiiframework.com/doc/guide/1.1/en/topics.auth
        $auth = Yii::app()->authManager;

        $role=$auth->createRole('admin');
        $auth->assign('admin', 'admin');
    }
}
?>

