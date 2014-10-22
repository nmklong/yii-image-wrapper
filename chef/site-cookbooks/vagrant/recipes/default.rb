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
