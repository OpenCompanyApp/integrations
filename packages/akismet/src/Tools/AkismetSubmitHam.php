<?php

namespace OpenCompany\Integrations\Akismet\Tools;

/**
 * Submit false-positive ham feedback.
 */
class AkismetSubmitHam extends AkismetCommentCheck
{
    protected const NAME = 'akismet_submit_ham';
    protected const DESCRIPTION = 'Submit false-positive ham feedback to Akismet using the original content metadata as closely as possible.';
    protected const METHOD = 'submitHam';
}
