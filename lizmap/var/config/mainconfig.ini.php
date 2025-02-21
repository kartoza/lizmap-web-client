;<?php die(''); ?>
;for security reasons , don't remove or modify the first line
;this file doesn't list all possible properties. See lib/jelix/core/defaultconfig.ini.php for that

; WARNING: IF YOU WANT TO MODIFY SOME OPTIONS, SET THEM INTO localconfig.ini.php.
; Don't change them here.

locale=en_US
charset=UTF-8

; see http://www.php.net/manual/en/timezones.php for supported values
timeZone="Europe/Paris"

theme=default

pluginsPath="app:plugins,lib:jelix-plugins,module:jacl2db/plugins"
modulesPath="lib:jelix-admin-modules,lib:jelix-modules,app:modules,app:lizmap-modules,app:vendor/jelix/jcommunity-module/modules"

; the locales available in the application
availableLocales="cs_CZ,de_DE,el_GR,en_US,es_ES,eu_ES,fi_FI,fr_FR,gl_ES,hu_HU,it_IT,ja_JP,nl_NL,pl_PL,pt_BR,pt_PT,ro_RO,ru_RU,sl_SI,sv_SE,sk_SK,uk_UA"
; the locale to fallback when the asked string doesn't exist in the current locale
fallbackLocale=en_US

[coordplugins]
;name = file_ini_name or 1
autolocale=1

[tplplugins]
defaultJformsBuilder=html

[responses]
html=myHtmlResponse
htmlmap=myHtmlMapResponse
htmlsimple=simpleHtmlResponse

[jResponseHtml]

[error_handling]
messageLogFormat="%date%\t[%code%]\t%msg%\t%file%\t%line%\n"
errorMessage="An error occured. Sorry for the inconvenience."

[compilation]
checkCacheFiletime=on
force=off

[urlengine]
; name of url engine :  "simple", "basic_significant" or "significant"
engine=basic_significant

; this is the url path to the jelix-www content (you can found this content in lib/jelix-www/)
; because the jelix-www directory is outside the yourapp/www/ directory, you should create a link to
; jelix-www, or copy its content in yourapp/www/ (with a name like 'jelix' for example)
; so you should indicate the relative path of this link/directory to the basePath, or an absolute path.
jelixWWWPath="assets/jelix/"
jqueryPath="assets/jelix/jquery/"

; enable the parsing of the url. Set it to off if the url is already parsed by another program
; (like mod_rewrite in apache), if the rewrite of the url corresponds to a simple url, and if
; you use the significant engine. If you use the simple url engine, you can set to off.
enableParser=on

multiview=off

; basePath corresponds to the path to the base directory of your application.
; so if the url to access to your application is http://foo.com/aaa/bbb/www/index.php, you should
; set basePath = "/aaa/bbb/www/".
; if it is http://foo.com/index.php, set basePath="/"
; Jelix can guess the basePath, so you can keep basePath empty. But in the case where there are some
; entry points which are not in the same directory (ex: you have two entry point : http://foo.com/aaa/index.php
; and http://foo.com/aaa/bbb/other.php ), you MUST set the basePath (ex here, the higher entry point is index.php so
; : basePath="/aaa/" )
basePath=

defaultEntrypoint=index

; leave empty to have jelix error messages
;notfoundAct=
notfoundAct="jelix~error:notfound"

; list of actions which require https protocol for the simple url engine
; syntax of the list is the same as explained in the simple_urlengine_entrypoints
simple_urlengine_https=

[simple_urlengine_entrypoints]
; parameters for the simple url engine. This is the list of entry points
; with list of actions attached to each entry points

; script_name_without_suffix = "list of action selectors separated by a space"
; selector syntax :
;   m~a@r    -> for the action "a" of the module "m" and for the request of type "r"
;   m~*@r    -> for all actions of the module "m" and for the request of type "r"
;   @r       -> for all actions for the request of type "r"

index="@classic"
admin="jacl2db~*@classic,jacl2db_admin~*@classic,jauthdb_admin~*@classic,master_admin~*@classic,admin~*@classic,jcommunity~*@classic"


[basic_significant_urlengine_entrypoints]
; for each entry point, it indicates if the entry point name
; should be include in the url or not
index=on
admin=on

[basic_significant_urlengine_aliases]
auth=jcommunity


[logger]
_all=
default=file
error=file
warning=file
notice=file
;deprecated=syslog
strict=file
;sql=syslog
metric=syslog
auth=

[fileLogger]
default=messages.log
error=errors.log
warning=errors.log
notice=errors.log
strict=errors.log
;metric=time.log
auth=messages.log

[mailer]
webmasterEmail="root@localhost"
webmasterName=

; how to send mail : "mail" (mail()), "sendmail" (call sendmail), or "smtp" (send directly to a smtp)
mailerType=mail
; Sets the hostname to use in Message-Id and Received headers
; and as default HELO string. If empty, the value returned
; by SERVER_NAME is used or 'localhost.localdomain'.
hostname=
sendmailPath="/usr/sbin/sendmail"

; if mailer = smtp , fill the following parameters

; SMTP hosts.  All hosts must be separated by a semicolon : "smtp1.example.com:25;smtp2.example.com"
smtpHost=localhost
; default SMTP server port
smtpPort=25
; secured connection or not. possible values: "", "ssl", "tls"
smtpSecure=
; SMTP HELO of the message (Default is hostname)
smtpHelo=
; SMTP authentication
smtpAuth=off
smtpUsername=
smtpPassword=
; SMTP server timeout in seconds
smtpTimeout=10



[acl2]
driver=db

[coordplugin_jacl2]
; What to do if a right is required but the user has not this right
; 1 = generate an error. This value should be set for web services (xmlrpc, jsonrpc...)
; 2 = redirect to an action
on_error=2

; locale key for the error message when on_error=1
error_message="jelix~errors.acl.action.right.needed"

; action to execute on a missing authentification when on_error=2
on_error_action="jcommunity~login:index"


[coordplugin_autolocale]
; activate the detection from a parameter given in the url
enableUrlDetection=on

; indicate the parameter name indicating the language/locale to use
urlParamNameLanguage=lang


; if no url parameter found, indicate to use one of the prefered language given by the browser
useDefaultLanguageBrowser=on

[sessions]
; to disable sessions, set the following parameter to 0
start=1
; You can change the session name by setting the following parameter (only accepts alpha-numeric chars) :
; name = "mySessionName"
; Use alternative storage engines for sessions
;
; usage :
;
; storage = "files"
; files_path = "app:var/sessions/"
;
; or
;
; storage = "dao"
; dao_selector = "jelix~jsession"
; dao_db_profile = ""


[forms]
; define input type for datetime widgets : "textboxes" or "menulists"
controls.datetime.input=menulists
; define the way month labels are displayed widgets: "numbers", "names" or "shortnames"
; controls.datetime.months.labels=names
controls.datetime.months.labels=numbers
; define the default config for datepickers in jforms
datepicker=default
datetimepicker=default

[jquery]
jquery="assets/js/jquery/jquery-3.5.1.min.js"
jqueryui.js[]="assets/js/jquery/ui-1.12.1/jquery-ui.min.js"
jqueryui.css[]="assets/js/jquery/ui-1.12.1/jquery-ui.min.css"

[datepickers]
default="$jelix/js/jforms/datepickers/default/init.js"
default.js[]="assets/js/jquery/ui-1.12.1/jquery-ui.min.js"
default.js[]="$jelix/js/jforms/datepickers/default/ui.en.js"
default.js[]="$jqueryPath/ui/i18n/jquery.ui.datepicker-$lang.js"
default.js[]="$jelix/js/jforms/datepickers/default/ui.$lang.js"
default.css[]="assets/js/jquery/ui-1.12.1/jquery-ui.min.css"

[datetimepickers]
default="$jelix/js/jforms/datepickers/default/init.js"
default.js[]="assets/js/jquery/ui-1.12.1/jquery-ui.min.js"
default.js[]="$jelix/js/jforms/datepickers/default/ui.en.js"
default.js[]="$jqueryPath/ui/i18n/jquery.ui.datepicker-$lang.js"
default.js[]="$jelix/js/jforms/datepickers/default/ui.$lang.js"
default.css[]="assets/js/jquery/ui-1.12.1/jquery-ui.min.css"

[htmleditors]
default.engine.name=ckeditor
default.engine.file[]="assets/js/ckeditor5/ckeditor.js"
default.engine.file[]="assets/js/ckeditor5/translations/$lang.js"
default.config="assets/js/ckeditor5/ckeditor_lizmap.js"
default.skin.default=

ckdefault.engine.name=ckeditor
ckdefault.engine.file[]="assets/js/ckeditor5/ckeditor.js"
default.engine.file[]="assets/js/ckeditor5/translations/$lang.js"
ckdefault.config="assets/js/ckeditor5/ckeditor_ckdefault.js"

ckfull.engine.name=ckeditor
ckfull.engine.file[]="assets/js/ckeditor5/ckeditor.js"
default.engine.file[]="assets/js/ckeditor5/translations/$lang.js"
ckfull.config="assets/js/ckeditor5/ckeditor_ckfull.js"

ckbasic.engine.name=ckeditor
ckbasic.engine.file[]="assets/js/ckeditor5/ckeditor.js"
default.engine.file[]="assets/js/ckeditor5/translations/$lang.js"
ckbasic.config="assets/js/ckeditor5/ckeditor_ckbasic.js"

ckfullandmedia.engine.name=ckeditor
ckfullandmedia.engine.file[]="assets/js/ckeditor5/ckeditor.js"
ckfullandmedia.config="assets/js/ckeditor5/ckeditor_ckfullandmedia.js"

[modules]
jelix.access=1

jacl.access=0
jacldb.access=0
jpref.access=0
jsoap.access=0
junittests.access=0
jpref_admin.access=0

jacl2.access=1
jacl2db.access=1
jacl2db.installparam=defaultuser

jauth.access=0
jauthdb.access=0

jcommunity.access=1
jcommunity.installparam="defaultusers=lizmap~defaultusers.json;manualconfig"

admin.access=1
dataviz.access=1
filter.access=1
action.access=1
dynamicLayers.access=1
lizmap.access=1
proj4php.access=1
view.access=1

ldapdao.installparam=noconfigfile
multiauth.installparam="noconfigfile;localconfig"

ldapdao.path="app:vendor/jelix/ldapdao-module/ldapdao"

saml.installparam="localconfig"


[mailLogger]
email="root@localhost"
emailHeaders="Content-Type: text/plain; charset=UTF-8\nFrom: webmaster@yoursite.com\nX-Mailer: Jelix\nX-Priority: 1 (Highest)\n"

[jcommunity]
loginResponse=htmlauth
registrationEnabled=off
resetPasswordEnabled=on
resetAdminPasswordEnabled=on
verifyNickname=off
;passwordChangeEnabled=on
;accountDestroyEnabled=on
useJAuthDbAdminRights=on
;disableJPref = on

;------- some parameters for the "saml" module
[saml:sp]
; list of dao properties that can be used for mapping
daoPropertiesForMapping="login,email,firstname,lastname,phonenumber"

[pgsqlSchemaTimeout]
; list of timeout for each schema to be sure we have a different connection
; for each lizmap modules, to not share the same search_path. See QgisVectorLayer.
cadastre=31
adresse=32
openads=33


[lizmap]
; this the revision number to add to url of assets. If empty, no revision will be added.
; If "autoconfig", the revision number will be generated automatically each time
; the configuration will be compiled. Else a value can be given directly into the
; configuration, but it is the responsibility to the developer or the administrator
; to indicate a new one each time the application is deployed for example.
assetsRevision = autoconfig