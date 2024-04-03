REM Build versioned assets

@echo off
cls

set /p ver=Please enter the version: 
echo "Using version: %ver%"

mkdir "%~dp0public\js\steamwidgets\%ver%"
mkdir "%~dp0public\css\steamwidgets\%ver%"

del "%~dp0public\js\steamwidgets\%ver%\steam_app.js"
del "%~dp0public\css\steamwidgets\%ver%\steam_app.css"

del "%~dp0public\js\steamwidgets\%ver%\steam_server.js"
del "%~dp0public\css\steamwidgets\%ver%\steam_server.css"

del "%~dp0public\js\steamwidgets\%ver%\steam_user.js"
del "%~dp0public\css\steamwidgets\%ver%\steam_user.css"

del "%~dp0public\js\steamwidgets\%ver%\steam_workshop.js"
del "%~dp0public\css\steamwidgets\%ver%\steam_workshop.css"

del "%~dp0public\js\steamwidgets\%ver%\steam_group.js"
del "%~dp0public\css\steamwidgets\%ver%\steam_group.css"

xcopy "%~dp0app\resources\js\steam_app.dev.js" "%~dp0public\js\steamwidgets\%ver%\" /Y
xcopy "%~dp0app\resources\css\steam_app.dev.css" "%~dp0public\css\steamwidgets\%ver%\" /Y

xcopy "%~dp0app\resources\js\steam_server.dev.js" "%~dp0public\js\steamwidgets\%ver%\" /Y
xcopy "%~dp0app\resources\css\steam_server.dev.css" "%~dp0public\css\steamwidgets\%ver%\" /Y

xcopy "%~dp0app\resources\js\steam_user.dev.js" "%~dp0public\js\steamwidgets\%ver%\" /Y
xcopy "%~dp0app\resources\css\steam_user.dev.css" "%~dp0public\css\steamwidgets\%ver%\" /Y

xcopy "%~dp0app\resources\js\steam_workshop.dev.js" "%~dp0public\js\steamwidgets\%ver%\" /Y
xcopy "%~dp0app\resources\css\steam_workshop.dev.css" "%~dp0public\css\steamwidgets\%ver%\" /Y

xcopy "%~dp0app\resources\js\steam_group.dev.js" "%~dp0public\js\steamwidgets\%ver%\" /Y
xcopy "%~dp0app\resources\css\steam_group.dev.css" "%~dp0public\css\steamwidgets\%ver%\" /Y

ren "%~dp0public\js\steamwidgets\%ver%\steam_app.dev.js" "steam_app.js"
ren "%~dp0public\css\steamwidgets\%ver%\steam_app.dev.css" "steam_app.css"

ren "%~dp0public\js\steamwidgets\%ver%\steam_server.dev.js" "steam_server.js"
ren "%~dp0public\css\steamwidgets\%ver%\steam_server.dev.css" "steam_server.css"

ren "%~dp0public\js\steamwidgets\%ver%\steam_user.dev.js" "steam_user.js"
ren "%~dp0public\css\steamwidgets\%ver%\steam_user.dev.css" "steam_user.css"

ren "%~dp0public\js\steamwidgets\%ver%\steam_workshop.dev.js" "steam_workshop.js"
ren "%~dp0public\css\steamwidgets\%ver%\steam_workshop.dev.css" "steam_workshop.css"

ren "%~dp0public\js\steamwidgets\%ver%\steam_group.dev.js" "steam_group.js"
ren "%~dp0public\css\steamwidgets\%ver%\steam_group.dev.css" "steam_group.css"

echo "Job done"

pause