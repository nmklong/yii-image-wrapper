# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure('2') do |config|

    config.vm.box = 'precise32'
    config.vm.box_url = 'http://boxes.cogini.com/precise32.box'

    config.vm.network :forwarded_port, guest: 80, host: 9010
    config.vm.network :forwarded_port, guest: 22, host: 9011, id: "ssh", auto_correct: true

    # apt wants the partial folder to be there
    apt_cache = './.cache/apt'
    FileUtils.mkpath "#{apt_cache}/partial"

    chef_cache = '/var/chef/cache'

    shared_folders = {
        apt_cache => '/var/cache/apt/archives',
        './.cache/chef' => chef_cache,
    }

    config.vm.provider :virtualbox do |vb|

        #vb.gui = true

        shared_folders.each do |source, destination|
            FileUtils.mkpath source
            config.vm.synced_folder source, destination
            vb.customize ['setextradata', :id, "VBoxInternal2/SharedFoldersEnableSymlinksCreate/#{destination}", '1']
        end

        vb.customize ['setextradata', :id, 'VBoxInternal2/SharedFoldersEnableSymlinksCreate/v-root', '1']
    end


    config.vm.provision :chef_solo do |chef|

        chef.provisioning_path = chef_cache

        chef.cookbooks_path = [
            'chef/chef-cookbooks',
            'chef/site-cookbooks',
        ]

        chef.json = {
            :image_wrapper => {
                :server_name => 'localhost',
                :log_dir => '/vagrant/logs',
                :site_dir => '/vagrant',
                :admin_email => 'support@vagrant.local',
                :db => {
                    :password => 'vagrant',
                },
                :app_user => 'vagrant',
            },

            # Attributes for vagrant machine
            :apache => {
                :user => 'vagrant',
            },
            :php => {
                :fpm => {
                    :user => 'vagrant',
                },
            },
            :nginx => {
                :sendfile => 'off',
            },
            :mysql => {
                :server_root_password => 'vagrant',
            },
            :postgresql => {
                :client_auth => [
                    {
                        :type => 'local',
                        :database => 'all',
                        :user => 'all',
                        :auth_method => 'trust',
                    }
                ]
            }
        }

        chef.add_recipe 'vagrant'

        #chef.data_bags_path = '../my-recipes/data_bags'
    end
end
