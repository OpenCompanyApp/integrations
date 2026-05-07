<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Delete one Bitrise app. */
class BitriseDeleteApp extends AbstractBitriseTool { protected const NAME = 'bitrise_delete_app'; protected const DESCRIPTION = 'Delete one Bitrise app by app slug. This operation is permanent in Bitrise.'; protected const METHOD = 'deleteApp'; protected const ARGUMENTS = ['app_slug']; }
