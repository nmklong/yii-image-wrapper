# How to setup SSL

- Set these 2 attributes in your chef json:
  + `node[:skeleton][:ssl][:cert]`
  + `node[:skeleton][:ssl][:key]`

- Put the cert and key files in the 2 places mentioned above
