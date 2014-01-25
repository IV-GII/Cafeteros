sudo pip install paramiko PyYAML jinja2 httplib2 ansible
sudo apt-get install -y ssh-copy-id
ssh-copy-id -i ~/.ssh/id_rsa.pub pi@192.168.1.65
# Descargar proyecto cafeteros y archivo con el host
cd ~
git@github.com:IV-GII/Cafeteros.git
cd cafeteros
#Provisionar la máquina
ansible-playbook scripts/raspiPlaybook.yml -i scripts/ansibleHosts -u pi
