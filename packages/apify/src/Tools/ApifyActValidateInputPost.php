<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Validate Actor input.
 *
 * Executes the official Apify API operation act_validateInput_post.
 */
class ApifyActValidateInputPost extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_validate_input_post';
}
