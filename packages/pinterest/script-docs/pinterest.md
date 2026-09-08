# Pinterest — Ruby API Reference

## list_pins

List pins for the authenticated Pinterest user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `bookmark` | string | no | Pagination cursor from a previous response |
| `pageSize` | integer | no | Number of pins to return per page (max 250) |

### Example

```ruby
result = app.integrations.pinterest.list(page_size: 25)
result.items.each do |pin|
  puts((pin.id).to_s + ": " + ((pin.title || "")).to_s)
end
```
---

## get_pin

Get details of a specific pin by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pinId` | string | yes | The pin ID to retrieve |

### Example

```ruby
result = app.integrations.pinterest.get(pin_id: "1234567890")
puts(result.title)
puts(result.description)
puts(result.link)
```
---

## create_pin

Create a new pin on a Pinterest board.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `boardId` | string | yes | The board ID to pin to |
| `title` | string | yes | The title of the pin |
| `description` | string | yes | The description of the pin |
| `mediaSource` | string | no | The media source type (default: `"image_url"`) |
| `imageUrl` | string | yes | The URL of the image to pin |
| `link` | string | no | Optional destination link URL for the pin |

### Example

```ruby
result = app.integrations.pinterest.create(board_id: "987654321", title: "My New Pin", description: "Check out this amazing content!", image_url: "https://example.com/image.jpg", link: "https://example.com/blog")
puts("Created pin: " + (result.id).to_s)
```
---

## list_boards

List boards for the authenticated Pinterest user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `bookmark` | string | no | Pagination cursor from a previous response |
| `pageSize` | integer | no | Number of boards to return per page (max 250) |

### Example

```ruby
result = app.integrations.pinterest.list_boards(page_size: 25)
result.items.each do |board|
  puts((board.id).to_s + ": " + (board.name).to_s + " (" + ((board.pin_count || 0)).to_s + " pins)")
end
```
---

## get_board

Get details of a specific board by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `boardId` | string | yes | The board ID to retrieve |

### Example

```ruby
result = app.integrations.pinterest.get_board(board_id: "1234567890")
puts(result.name)
puts(result.description)
puts("Pin count: " + ((result.pin_count || 0)).to_s)
```
---

## list_campaigns

List ad campaigns for a Pinterest ad account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `adAccountId` | string | yes | The ad account ID to list campaigns for |
| `bookmark` | string | no | Pagination cursor from a previous response |
| `pageSize` | integer | no | Number of campaigns to return per page |

### Example

```ruby
result = app.integrations.pinterest.list_campaigns(ad_account_id: "549560687913", page_size: 50)
result.items.each do |campaign|
  puts((campaign.id).to_s + ": " + (campaign.name).to_s + " (" + (campaign.status).to_s + ")")
end
```
---

## get_current_user

Get the currently authenticated Pinterest user profile.

### Parameters

None.

### Example

```ruby
result = app.integrations.pinterest.get_current_user()
puts("Logged in as: " + ((result.username || "")).to_s)
puts("Account type: " + ((result.account_type || "")).to_s)
```
---

## Multi-Account Usage

If you have multiple Pinterest accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts — only the credentials differ.
