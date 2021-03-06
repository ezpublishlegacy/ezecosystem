<?php /* #?ini charset="utf-8"?

[OWSimpleOperatorSettings]
# Display Function Call and Results via ezDebug:writeDebug
DebugOutput=disabled

# Names of system functions that
# are usable as template operators

[PHPFunctions]
PermittedFunctionList[]
PermittedFunctionList[]=time
PermittedFunctionList[]=mktime
PermittedFunctionList[]=getdate
PermittedFunctionList[]=str_replace
PermittedFunctionList[]=ereg_replace
PermittedFunctionList[]=str_rot13
PermittedFunctionList[]=file_get_contents
PermittedFunctionList[]=preg_replace

# Class file path, Class Name, Class Method
# that are useable as template operators

[ClassOperators]
PermittedClassOperatorList[]
PermittedClassOperatorList[]=extension/ezecosystem/classes/operators/ezecosystemsimpleoperators.php;eZecosystemSimpleOperators;html_entity_decode_numeric
PermittedClassOperatorList[]=extension/ezecosystem/classes/operators/ezecosystemsimpleoperators.php;eZecosystemSimpleOperators;popular_sidebar_fetch
PermittedClassOperatorList[]=extension/ezecosystem/classes/operators/ezecosystemsimpleoperators.php;eZecosystemSimpleOperators;html5_iframe_append_closing_tag

*/ ?>