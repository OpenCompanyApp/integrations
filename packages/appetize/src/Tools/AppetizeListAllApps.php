<?php

namespace OpenCompany\Integrations\Appetize\Tools;

/** List all Appetize apps without pagination. */
class AppetizeListAllApps extends AbstractAppetizeTool { protected const NAME = 'appetize_list_all_apps'; protected const DESCRIPTION = 'List all Appetize apps without pagination. Prefer paginated list for large accounts.'; protected const METHOD = 'listAllApps'; }
