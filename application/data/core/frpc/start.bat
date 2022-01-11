@echo off
set retime=60
:start
F:\app\客户端frp_0.30.0_windows_amd64\frpc.exe -c  F:\app\客户端frp_0.30.0_windows_amd64\frpc.ini
echo Error
echo --------------------------------------------
echo 连节点或登入失败-即将在%retime%秒后重新连
echo --------------------------------------------
timeout /t %retime% 
goto start