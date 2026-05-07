<?php

namespace OpenCompany\Integrations\Codemagic\Tools;

/** List Codemagic applications. */
class CodemagicListApps extends AbstractCodemagicTool { protected const NAME = 'codemagic_list_apps'; protected const DESCRIPTION = 'List Codemagic applications accessible to the authenticated token.'; protected const METHOD = 'listApps'; protected const USE_QUERY = true; }
