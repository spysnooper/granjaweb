# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = "2"
#VAGRANT_STORAGE_POOL = "maquinas_virtuales-1"
VAGRANT_STORAGE_POOL = "default"

Vagrant.require_version ">= 1.8.0"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  vagrant_cluster_config = {
    "box_name"  => ENV['VAGRANT_BOX_NAME'] || "centos/7",
    "num_hosts" => ENV['VAGRANT_NUM_HOSTS'] || 6,
    "lb_node_mem"  => ENV['VAGRANT_LB_NODE_MEM'] || 1024,
    "nfs_node_mem"  => ENV['VAGRANT_NFS_NODE_MEM'] || 512,
    "app_node_mem"  => ENV['VAGRANT_APP_NODE_MEM'] || 512
  }

# Cofiguramos la plantilla a utilizar
  config.vm.box = vagrant_cluster_config["box_name"]

# Disabling the default /vagrant share
  config.vm.synced_folder ".", "/vagrant", disabled: true

# 1: NGINX (lb-node)
# 2: Apache Node 1 (app-node)
# 3: Apache Node 2 (app-node)
# 4: NFS Node 1 (nfs-node)
  N = (vagrant_cluster_config['num_hosts']).to_i
  
  (1..N).each do |i|
    if i == 1
# nginx load-balancer node
      vm_name = "lb-node1"
      vm_memory = vagrant_cluster_config['lb_node_mem']
    else
        if i == 2
# nfs nodes
            vm_name = "nfs-node1"
            vm_memory = vagrant_cluster_config['nfs_node_mem']
        else
# webserver nodes
            vm_name = "app-node#{i-2}"
            vm_memory = vagrant_cluster_config['app_node_mem']
        end
    end		# end if

    config.vm.define "#{vm_name}" do |node|
      node.vm.hostname = "#{vm_name}"
      if Vagrant.has_plugin?("vagrant-libvirt")
        node.vm.provider :libvirt do |domain|
          domain.uri = 'qemu+unix:///system'
          domain.driver = 'kvm'
          domain.storage_pool_name = VAGRANT_STORAGE_POOL
          domain.memory = "#{vm_memory}".to_i
          domain.cpus = 1
        end	# end domain
      end	# end if
    end		# end node
  end 		# end i
  config.vm.provision :ansible do |ansible|
    ansible.groups = {
      "loadbalancers" => ["lb-node1"],
      "nfs-server" => ["nfs-node1"],
      "webservers" => ["app-node1", "app-node2", "app-node3", "app-node4"],
      "servers:children" => ["loadbalancers", "webservers", "nfs-server"]
    }
    ansible.playbook = "./ansible/playbook.yml"
    #ansible.verbose = 'v'
  end		# end ansible
end 		# end config
