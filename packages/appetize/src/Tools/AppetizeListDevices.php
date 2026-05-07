<?php

namespace OpenCompany\Integrations\Appetize\Tools;

/** List Appetize devices and OS versions. */
class AppetizeListDevices extends AbstractAppetizeTool { protected const NAME = 'appetize_list_devices'; protected const DESCRIPTION = 'List supported Appetize devices and OS versions.'; protected const METHOD = 'listDevices'; protected const USE_QUERY = true; }
