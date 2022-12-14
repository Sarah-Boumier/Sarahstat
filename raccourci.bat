@echo off
set SCRIPT="%TEMP%\%RANDOM%-%RANDOM%-%RANDOM%-%RANDOM%.vbs"
echo Set oWS = WScript.CreateObject("WScript.Shell") >> %SCRIPT%
echo sLinkFile = "%USERPROFILE%\Desktop\Sarahstat.lnk" >> %SCRIPT%
echo Set oLink = oWS.CreateShortcut(sLinkFile) >> %SCRIPT%
echo oLink.TargetPath = "C:\wamp64\www\Twitter\Classement-de-vos-dm-twitter-main\launch sarahstat.bat" >> %SCRIPT%
echo oLink.IconLocation = "C:\wamp64\www\Twitter\Classement-de-vos-dm-twitter-main\image\db.ico">> %SCRIPT%
echo oLink.Arguments = "-h Window7 -a ifix" >> %SCRIPT%
echo oLink.Save >> %SCRIPT%
cscript /nologo %SCRIPT%
del %SCRIPT%