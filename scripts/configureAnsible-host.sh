sudo pip install paramiko PyYAML jinja2 httplib2 ansible
echo "192.168.1.65" > ~/ansible_hosts
export ANSIBLE_HOSTS=~/ansible_hosts
sudo apt-get install -y ssh-copy-id
ssh-copy-id -i ~/.ssh/id_rsa.pub pi@192.168.1.65

