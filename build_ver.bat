@echo off
cls

set /p ver=Please enter the version: 
echo "Using version: %ver%"

mkdir "%~dp0public\js\steamcards\%ver%"
mkdir "%~dp0public\css\steamcards\%ver%"

del "%~dp0public\js\steamcards\%ver%\steam_app.js"
del "%~dp0public\css\steamcards\%ver%\steam_app.css"

del "%~dp0public\js\steamcards\%ver%\steam_server.js"
del "%~dp0public\css\steamcards\%ver%\steam_server.css"

del "%~dp0public\js\steamcards\%ver%\steam_user.js"
del "%~dp0public\css\steamcards\%ver%\steam_user.css"

xcopy "%~dp0app\resources\js\steam_app.dev.js" "%~dp0public\js\steamcards\%ver%\" /Y
xcopy "%~dp0app\resources\css\steam_app.dev.css" "%~dp0public\css\steamcards\%ver%\" /Y

xcopy "%~dp0app\resources\js\steam_server.dev.js" "%~dp0public\js\steamcards\%ver%\" /Y
xcopy "%~dp0app\resources\css\steam_server.dev.css" "%~dp0public\css\steamcards\%ver%\" /Y

xcopy "%~dp0app\resources\js\steam_user.dev.js" "%~dp0public\js\steamcards\%ver%\" /Y
xcopy "%~dp0app\resources\css\steam_user.dev.css" "%~dp0public\css\steamcards\%ver%\" /Y

ren "%~dp0public\js\steamcards\%ver%\steam_app.dev.js" "steam_app.js"
ren "%~dp0public\css\steamcards\%ver%\steam_app.dev.css" "steam_app.css"

ren "%~dp0public\js\steamcards\%ver%\steam_server.dev.js" "steam_server.js"
ren "%~dp0public\css\steamcards\%ver%\steam_server.dev.css" "steam_server.css"

ren "%~dp0public\js\steamcards\%ver%\steam_user.dev.js" "steam_user.js"
ren "%~dp0public\css\steamcards\%ver%\steam_user.dev.css" "steam_user.css"

echo "Job done"

pause