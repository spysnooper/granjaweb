Este repo es para probar conjuntamente Vagrant y Ansible, para lo cual creamos un entorno de 4 servidores centos 7
El inventario lo genera vagrant, las IPs son dinamicas y los nombres se resuelven automaticamente con dnsmasq
- NGINX / NFS-server (lb-node1)
- Apache (app-node1)
- Apache (app-node2)
- Apache (app-node3)

Para saber las IPs de las maquinas virtuales
- ansible all --private-key=~/.vagrant.d/insecure_private_key -u vagrant -i .vagrant/provisioners/ansible/inventory -m setup -a "filter=ansible_all_ipv4*"


Para descargar el box de centos 7 o instalar plugins de vagrant, si necesitamos proxy:
- export VAGRANT_PROXY_HTTP="http://myproxy:port"
- export VAGRANT_PROXY_HTTPS="http://myproxy:port"


Para provisionar con libvirt es necesario instalar un plugin de vagrant
- sudo vagrant plugin install vagrant-libvirt


Para establecer el proxy en las maquinas virtuales es necesario vagrant-proxyconf
- sudo vagrant plugin install vagrant-proxyconf

Eliminar las maquinas virtuales
- vagrant destroy
- rm -vfr .vagrant/

Crear las maquinas virtuales
- vagrant up

Para volver a provisionar con Ansible las maquinas virtuales
- vagrant provision

Example to test variables
- ansible all --private-key=~/.vagrant.d/insecure_private_key -u vagrant -i .vagrant/provisioners/ansible/inventory -m command -a "echo {{ groups['webservers'][0] }}"
