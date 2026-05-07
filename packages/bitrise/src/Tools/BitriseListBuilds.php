<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** List builds accessible to the account. */
class BitriseListBuilds extends AbstractBitriseTool { protected const NAME = 'bitrise_list_builds'; protected const DESCRIPTION = 'List Bitrise builds accessible to the authenticated account.'; protected const METHOD = 'listBuilds'; protected const USE_QUERY = true; }
