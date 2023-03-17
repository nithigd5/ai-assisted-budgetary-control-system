FROM dorowu/ubuntu-desktop-lxde-vnc

# install pycharm professional

COPY 'pycharm-professional-2022.3.3.tar.gz' 'pycharm-professional.tar.gz'

RUN tar -xvf 'pycharm-professional.tar.gz'

RUN chmod +x 'pycharm-2022.3.3/bin/pycharm.sh'

#RUN #ln -s 'pycharm-2022.3.3/bin/pycharm.sh' 'Desktop/pycharm'