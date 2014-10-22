#
# Cookbook Name:: vagrant
# Recipe:: default
#
# Copyright 2012, Cogini
#
# All rights reserved - Do Not Redistribute
#

# FIXME: git should be installed in yii_framework, 
# but run_context.include_recipe 'git' doesn't work

include_recipe 'git'
include_recipe 'main'
include_recipe 'nodejs'


execute 'npm install -g socket.io'


csync_path = "#{node[:skeleton][:site_dir]}/css-sync"

git "Clone css-sync" do
    repository "https://github.com/ubolonton/css-sync.git"
    reference "master"
    destination csync_path
end

template '/etc/init/css-sync.conf' do
    source 'upstart-csync.erb'
    mode '0644'
end

template "#{csync_path}/config.js" do
    source 'csync_config.js.erb'
    mode '0644'
end


service 'css-sync' do
    provider Chef::Provider::Service::Upstart
    action [:enable, :start]
end