<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** List archived builds for a Bitrise app. */
class BitriseListArchivedBuilds extends AbstractBitriseTool { protected const NAME = 'bitrise_list_archived_builds'; protected const DESCRIPTION = 'List archived builds for a Bitrise app.'; protected const METHOD = 'listArchivedBuilds'; protected const ARGUMENTS = ['app_slug']; protected const USE_QUERY = true; }
