<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** List Android keystore files for a Bitrise app. */
class BitriseListAndroidKeystoreFiles extends AbstractBitriseTool { protected const NAME = 'bitrise_list_android_keystore_files'; protected const DESCRIPTION = 'List Android keystore files for a Bitrise app.'; protected const METHOD = 'listAndroidKeystoreFiles'; protected const ARGUMENTS = ['app_slug']; protected const USE_QUERY = true; }
