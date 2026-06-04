@echo off
chcp 65001 >nul
echo ============================================
echo   真颜堂中医诊所 - 推送到 GitHub
echo ============================================
echo.

cd /d "D:\cc\renova"

echo [1/3] 配置远程仓库...
git remote remove origin 2>nul
git remote add origin https://github.com/shishunhai2025/renova-clinic-website.git

echo [2/3] 推送代码（可能需要输入GitHub密码）...
git push -u origin main

echo.
echo [3/3] 完成！
echo 访问 https://github.com/shishunhai2025/renova-clinic-website 查看仓库
pause
