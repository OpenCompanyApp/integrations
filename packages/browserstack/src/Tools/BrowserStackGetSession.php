<?php

namespace OpenCompany\Integrations\BrowserStack\Tools;

/** Get one BrowserStack Automate session. */
class BrowserStackGetSession extends AbstractBrowserStackTool { protected const NAME = 'browserstack_get_session'; protected const DESCRIPTION = 'Get one BrowserStack Automate session by session id.'; protected const METHOD = 'getSession'; protected const ARGUMENTS = ['session_id']; }
