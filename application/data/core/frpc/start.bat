@echo off
set retime=60
:start
F:\app\�ͻ���frp_0.30.0_windows_amd64\frpc.exe -c  F:\app\�ͻ���frp_0.30.0_windows_amd64\frpc.ini
echo Error
echo --------------------------------------------
echo ���ڵ�����ʧ��-������%retime%���������
echo --------------------------------------------
timeout /t %retime% 
goto start