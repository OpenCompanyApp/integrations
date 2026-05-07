<?php

namespace OpenCompany\Integrations\Akismet\Tools;

/**
 * Check submitted content for spam.
 */
class AkismetCommentCheck extends AbstractAkismetTool
{
    protected const NAME = 'akismet_comment_check';
    protected const DESCRIPTION = 'Check submitted content with Akismet and return spam, pro-tip, and recheck metadata.';
    protected const METHOD = 'commentCheck';
    protected const REQUIRED = ['user_ip'];
    protected const PARAMETERS = [
        'user_ip' => ['type' => 'string', 'required' => true, 'description' => 'IP address of the submitter.'],
        'blog' => ['type' => 'string', 'required' => false, 'description' => 'Optional front-page URL override.'],
        'user_agent' => ['type' => 'string', 'required' => false, 'description' => 'Browser user-agent string from the submitted request.'],
        'referrer' => ['type' => 'string', 'required' => false, 'description' => 'HTTP referrer header value.'],
        'permalink' => ['type' => 'string', 'required' => false, 'description' => 'Permanent URL of the entry or context receiving the submission.'],
        'comment_type' => ['type' => 'string', 'required' => false, 'description' => 'Submission type, such as comment, forum-post, reply, blog-post, contact-form, signup, or message.'],
        'comment_author' => ['type' => 'string', 'required' => false, 'description' => 'Submitted author name.'],
        'comment_author_email' => ['type' => 'string', 'required' => false, 'description' => 'Submitted author email address.'],
        'comment_author_url' => ['type' => 'string', 'required' => false, 'description' => 'URL manually entered by the submitter.'],
        'comment_content' => ['type' => 'string', 'required' => false, 'description' => 'Submitted content body.'],
        'comment_context' => ['type' => 'array', 'required' => false, 'description' => 'Context tags or categories from the parent post or environment.', 'items' => ['type' => 'string']],
        'is_test' => ['type' => 'boolean', 'required' => false, 'description' => 'Mark this as a test query.'],
        'recheck_reason' => ['type' => 'string', 'required' => false, 'description' => 'Reason for rechecking existing content, such as edit or recheck.'],
    ];
}
