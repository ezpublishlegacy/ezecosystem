#?ini charset="utf-8"?

[eZJSCore]

# Disables/enables js / css packer (for debugging Apache rewrite rules)
# Normally controlled by [TemplateSettings]DevelopmentMode for convenience,
# but can also be specifically controlled by this setting if set.
# Force packer level by setting integer from 0 to 3 instead of [dis|en]abled
Packer=disabled

JavaScriptOptimizer[]
JavaScriptOptimizer[]=ezjscJavascriptOptimizer

CssOptimizer[]
CssOptimizer[]=ezjscCssOptimizer

## CDN Script settings (jQuery/ Yui integration)
# The following settings in this block are specific to ezjscore's
# jQuert / yui integrations and used by the ezjsc::[jquery|yui[2|3]] calls.
# You only need to change them if you:
# - Need to load these scripts locally (intranet / not rely on internet connection)
# - Want to add support for another js library / framework
# - Want to update the library it self
# You don't have to set up your js scripts with this, it's enough to just refer
# to them directly using {ezscript[_require]('somescript.js')} or
# {ezscript_require(array('ezjsc::jquery', 'somescript_that_uses_jquery.js'))}

# enable / disable loading the YUI / jQuery files from external servers
LoadFromCDN=disabled

# Preferred Library (can be 'yui3' or 'jquery')
# This is a preference hint to extensions that use ezjscore
# so they can optionally select to support both and select by this setting
PreferredLibrary=yui3
#PreferredLibrary=jquery

# List of external JavaScript YUI / jQuery libraries with their CDN URL
# If it starts with :// http or https will be selected based on if page is served as https or not
ExternalScripts[yui3]=http://yui.yahooapis.com/3.4.1/build/yui/yui-min.js
ExternalScripts[yui2]=http://yui.yahooapis.com/2.8.2/build/yuiloader/yuiloader-min.js
ExternalScripts[jquery]=://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js
ExternalScripts[jqueryUI]=//ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js

# List of local JavaScript YUI / jQuery libraries, optionally start with "/" to signal that its in
# root of design folder and not in /javascript sub folder
LocalScripts[yui3]=/lib/yui/3.4.1/build/yui/yui-min.js
LocalScripts[yui2]=/lib/yui/2.8.2/build/yuiloader/yuiloader-min.js
LocalScripts[jquery]=jquery-1.7.2rc1.js
LocalScripts[jqueryUI]=jquery-ui-1.8.18.custom.min.js

# Local base script path, needed for yui scripts (YUILoader)
LocalScriptBasePath[yui3]=lib/yui/3.4.1/build/
LocalScriptBasePath[yui2]=lib/yui/2.8.2/build/

[YUI3]
# List of options to put in the YUI3 config for dynamic loading
# see http://yuilibrary.com/yui/docs/api/classes/config.html
# Note: "base" option and "combine" (false) are automatically filled
# when loading the local version of YUI3
LoaderOptions[]
# uncomment to load the raw version (not minimized) of YUI3 files
#LoaderOptions[filter]=raw

[Packer]
# Appends the last modified time to the cached file name so Proxy/Browser cache
# is forced to re fetch file on change. Note: cronjob to cleanup expired
# files does not exist, but should be fairly trivial to create.
AppendLastModifiedTime=disabled

# For spreading the load of static files to separate domains as recommended by
# YDN Performance Best Practices. Key should match file extension: .js | .css
CustomHosts[]
# Example: Serve javascript files from static sub domain (No end slash!)
#CustomHosts[.js]=http://static.example.com



[ezjscServer]
# List of permission functions as used by the eZ Publish permission system
FunctionList[]=ezjsctemplate
#FunctionList[]=ezjsckeyword
#FunctionList[]=ezjscrating_rate


# Settings for setting up a server functions
# These are also supported by ezjscPacker, the class used in ezcss and ezscript
# Here is an example of setting up such a function:
#
#[ezjscServer_<custom_server>]
## Optional, uses <custom_server> as class name if not set
#Class=MyCustomJsGeneratorClass
## Optional, defines if a template is to be executed instead of a php class function
## In this case request will go to /templates/<class>/<function>.tpl
#TemplateFunction=true
## Optional, uses autoload system if not defined
#File=extension/ezjscore/classes/mycustomjsgenerator.php
## Optional, List of [ezjscServer]FunctionList functions user needs to have access to, Default: none
#Functions[]=ezjsc
## Optional, If pr function, then function name will be  appended to Function name like
## <FunctionList_name>_<funtion_name>, warning will be thrown if not set in FunctionList[].
## Default: disabled
#PermissionPrFunction=enabled
#
# Definition of use in template:
# {ezscript('<custom_server>::<funtion_name>[::arg1[::arg2]]')}

[ezjscServer_ezjsc]
# Url to test this server function(return current time):
# <root>/ezjscore/call/ezjsc::time
Class=ezjscServerFunctionsJs
#File=extension/ezjscore/classes/ezjscserverfunctionsjs.php

[ezjscServer_ezjscnode]
# Url to test this server function(return node list):
# <root>/ezjscore/call/ezjscnode::subtree::2
Class=ezjscServerFunctionsNode
#File=extension/ezjscore/classes/ezjscserverfunctionsnode.php

[ezjscServer_ezjsctemplate]
# Url to test this server function(return alert message):
# <root>/ezjscore/call/ezjsctemplate::alert
# will execute templates/ezjsctemplate/alert.tpl
TemplateFunction=true
Functions[]=ezjsctemplate

[ezjscServer_ezpublishingqueue]
Class=ezjscServerFunctionsPublishingQueue

[ezjscServer_ezajaxuploader]
Class=ezjscServerFunctionsAjaxUploader

[AjaxUploader]
AjaxUploadHandler[]
AjaxUploadHandler[ezobjectrelationlist]=ezpRelationListAjaxUploader
AjaxUploadHandler[ezobjectrelation]=ezpRelationAjaxUploader
