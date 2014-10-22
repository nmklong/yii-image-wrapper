set[:skeleton][:yii_version] = '1.1.13'

default[:skeleton][:app_user] = 'skeleton'
default[:skeleton][:csync_enable] = false
default[:skeleton][:csync_port] = 0
default[:skeleton][:db][:database] = 'skeleton'
default[:skeleton][:db][:host] = 'localhost'
default[:skeleton][:db][:user] = 'skeleton'

default[:skeleton][:python][:virtualenv] = '/home/skeleton/python-env'
default[:skeleton][:python][:build_dir] = '/home/skeleton/build'
set[:skeleton][:python][:schemup][:version] = '5f5d35f5c7e9708e62ca43aa4743610e2cb696ae'

default[:skeleton][:environment] = 'dev' # 'dev' or 'production'

default[:skeleton][:ssl] = nil
