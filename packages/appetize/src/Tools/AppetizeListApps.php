<?php

namespace OpenCompany\Integrations\Appetize\Tools;

/** List Appetize apps with pagination. */
class AppetizeListApps extends AbstractAppetizeTool { protected const NAME = 'appetize_list_apps'; protected const DESCRIPTION = 'List Appetize apps with optional nextKey pagination.'; protected const METHOD = 'listApps'; protected const USE_QUERY = true; }
