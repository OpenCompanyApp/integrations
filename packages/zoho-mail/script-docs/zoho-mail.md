# Zoho Mail Ruby API Reference

Namespace: `app.integrations["zoho-mail"]`

Configure a Zoho OAuth `access_token` and the regional Mail API base URL. The
default is `https://mail.zoho.com/api`; use the matching regional host such as
`https://mail.zoho.eu/api` when required.

## Accounts

```ruby
accounts = app.call("integrations.zoho-mail.list_accounts")
account = app.call("integrations.zoho-mail.get_account", account_id: "12345678")
```
The returned account IDs are required for every mailbox operation.

## Messages

List or search messages:

```ruby
page = app.call("integrations.zoho-mail.list_messages", account_id: "12345678", folder_id: "987654", start: 0, limit: 50)
search = app.call("integrations.zoho-mail.search_messages", account_id: "12345678", params: {searchKey: "from:billing@example.test", limit: 20})
```
Read content, metadata, headers, and original MIME:

```ruby
body = app.call("integrations.zoho-mail.get_message_content", account_id: "12345678", folder_id: "987654", message_id: "555555", include_block_content: false)
details = app.call("integrations.zoho-mail.get_message_details", account_id: "12345678", folder_id: "987654", message_id: "555555")
headers = app.call("integrations.zoho-mail.get_message_headers", account_id: "12345678", folder_id: "987654", message_id: "555555")
original = app.call("integrations.zoho-mail.get_original_message", account_id: "12345678", message_id: "555555")
```
Send, reply, update, or delete:

```ruby
app.call("integrations.zoho-mail.send_message", account_id: "12345678", to_address: "recipient@example.test", subject: "Status update", content: "<p>All set.</p>", mail_format: "html")
app.call("integrations.zoho-mail.reply_message", account_id: "12345678", message_id: "555555", payload: {toAddress: "sender@example.test", content: "<p>Thanks.</p>"})
app.call("integrations.zoho-mail.update_messages", account_id: "12345678", payload: {mode: "markAsRead", messageId: ["555555"]})
app.call("integrations.zoho-mail.delete_message", account_id: "12345678", folder_id: "987654", message_id: "555555")
```
## Attachments

```ruby
info = app.call("integrations.zoho-mail.get_attachment_info", account_id: "12345678", folder_id: "987654", message_id: "555555")
attachment = app.call("integrations.zoho-mail.get_attachment_content", account_id: "12345678", folder_id: "987654", message_id: "555555", attachment_id: "att-123")
```
## Folders

```ruby
folders = app.call("integrations.zoho-mail.list_folders", account_id: "12345678")
folder = app.call("integrations.zoho-mail.get_folder", account_id: "12345678", folder_id: "987654")
app.call("integrations.zoho-mail.create_folder", account_id: "12345678", payload: {folderName: "Invoices"})
app.call("integrations.zoho-mail.update_folder", account_id: "12345678", folder_id: "987654", payload: {mode: "renameFolder", folderName: "Receipts"})
```
## Labels

```ruby
labels = app.call("integrations.zoho-mail.list_labels", account_id: "12345678")
app.call("integrations.zoho-mail.create_label", account_id: "12345678", payload: {labelName: "Follow up", color: "#3366cc"})
```
## Tasks

```ruby
tasks = app.call("integrations.zoho-mail.list_tasks", account_id: "12345678", limit: 20)
```
## Raw API Helpers

Use raw helpers for documented Zoho Mail endpoints that do not yet have a named
tool. Paths must be relative; full URLs and parent-directory segments are
rejected.

```ruby
raw = app.call("integrations.zoho-mail.api_get", path: "/accounts/12345678/folders")
posted = app.call("integrations.zoho-mail.api_post", path: "/accounts/12345678/labels", payload: {labelName: "Review"})
```
## Multi-Account Usage

```ruby
app.call("integrations.zoho-mail.list_messages", account_id: "12345678")
app.call("integrations.zoho-mail.work.list_messages", account_id: "12345678")
```