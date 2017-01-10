Vagrantfile:
Este repo es para probar conjuntamente Vagrant y Ansible, para lo cual creamos un entorno de 4 servidores centos 7
# 1: NGINX / NFS-server (lb-node1)
# 2: Apache (app-node1)
# 3: Apache (app-node1)
# 4: Apache (app-node1)

Para descargar el box de centos 7 o instalar plugins de vagrant, si necesitamos proxy:
export VAGRANT_PROXY_HTTP="http://myproxy:port"
export VAGRANT_PROXY_HTTPS="http://myproxy:port"

Para provisionar con libvirt es necesario instalar un plugin de vagrant 
sudo vagrant plugin install vagrant-libvirt

Para establecer el proxy en las maquinas virtuales es necesario vagrant-proxyconf
sudo vagrant plugin install vagrant-proxyconf

vagrant destroy
rm -vfr .vagrant/
vagrant up

vagrant provision
