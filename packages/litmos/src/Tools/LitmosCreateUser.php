<?php

namespace OpenCompany\Integrations\Litmos\Tools;

use OpenCompany\Integrations\Litmos\LitmosService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new user in the Litmos LMS.
 *
 * Requires first name, last name, email, and username.
 */
class LitmosCreateUser implements Tool
{
    public function __construct(
        private LitmosService $service,
    ) {}

    public function name(): string
    {
        return 'litmos_create_user';
    }

    public function description(): string
    {
        return 'Create a new user in Litmos. Requires a first name, last name, email address, and username for login.';
    }

    public function parameters(): array
    {
        return [
            'FirstName' => ['type' => 'string', 'required' => true, 'description' => 'The user\'s first name.'],
            'LastName' => ['type' => 'string', 'required' => true, 'description' => 'The user\'s last name.'],
            'Email' => ['type' => 'string', 'required' => true, 'description' => 'The user\'s email address.'],
            'UserName' => ['type' => 'string', 'required' => true, 'description' => 'The user\'s login username.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Litmos integration is not configured.');
            }

            $required = ['FirstName', 'LastName', 'Email', 'UserName'];
            foreach ($required as $field) {
                if (empty($args[$field])) {
                    return ToolResult::error("The field '{$field}' is required.");
                }
            }

            $result = $this->service->createUser(
                $args['FirstName'],
                $args['LastName'],
                $args['Email'],
                $args['UserName'],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
