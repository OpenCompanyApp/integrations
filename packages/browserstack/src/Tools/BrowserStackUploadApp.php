<?php

namespace OpenCompany\Integrations\BrowserStack\Tools;

/** Upload a BrowserStack App Automate app by public URL. */
class BrowserStackUploadApp extends AbstractBrowserStackTool { protected const NAME = 'browserstack_upload_app'; protected const DESCRIPTION = 'Upload an App Automate app using a public URL and optional custom_id metadata.'; protected const METHOD = 'uploadApp'; protected const REQUIRED = ['payload']; protected const USE_PAYLOAD = true; }
