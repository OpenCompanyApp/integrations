<?php

namespace OpenCompany\Integrations\Akismet\Tools;

/**
 * Submit missed spam feedback.
 */
class AkismetSubmitSpam extends AkismetCommentCheck
{
    protected const NAME = 'akismet_submit_spam';
    protected const DESCRIPTION = 'Submit missed spam feedback to Akismet using the original content metadata as closely as possible.';
    protected const METHOD = 'submitSpam';
}
