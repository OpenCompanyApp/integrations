<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** List accessible Bitrise apps. */
class BitriseListApps extends AbstractBitriseTool { protected const NAME = 'bitrise_list_apps'; protected const DESCRIPTION = 'List Bitrise apps accessible to the authenticated token.'; protected const METHOD = 'listApps'; protected const USE_QUERY = true; }
