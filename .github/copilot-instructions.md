# Copilot Instructions for Laravel Livewire Starter Kit

## Project Architecture

This is a **Laravel 12 + Livewire 3 + Flux UI starter kit** with authentication features powered by Laravel Fortify. The architecture follows a component-based approach where Livewire handles reactive UI components instead of traditional controllers for most user interactions.

### Core Stack
- **Backend**: Laravel 12 (PHP 8.2+) with SQLite database
- **Frontend**: Livewire 3 + Flux UI components + Tailwind CSS v4
- **Authentication**: Laravel Fortify with 2FA support
- **Testing**: Pest PHP with Feature/Unit test separation
- **Build**: Vite with Laravel integration

## Key Patterns & Conventions

### Livewire Component Structure
- **Auth components** in `app/Livewire/Auth/` (Login, Register, etc.) use `#[Layout('components.layouts.auth')]`
- **Settings components** in `app/Livewire/Settings/` for user profile management
- Components use `#[Validate]` attributes for form validation instead of traditional request classes
- Authentication logic includes rate limiting with custom throttle keys

### Authentication Flow
- Fortify handles backend authentication logic, Livewire provides the UI components
- Two-factor authentication is integrated - check `Features::canManageTwoFactorAuthentication()`
- Session-based auth with remember tokens
- Custom views registered in `FortifyServiceProvider` point to Livewire components

### Routing Patterns
```php
// Settings routes with auth middleware
Route::middleware(['auth'])->group(function () {
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    // Route directly to Livewire component classes
});
```

### Database & Migrations
- Uses SQLite (`database/database.sqlite`) for local development
- Standard Laravel user table with additional 2FA columns (see `2025_09_22_145432_add_two_factor_columns_to_users_table.php`)
- Sessions table for authentication persistence

## Development Workflows

### Setup & Development
```bash
# Initial setup
composer run setup  # installs deps, creates .env, generates key, migrates DB, builds assets

# Development with concurrent processes
composer run dev     # starts: server, queue worker, logs (pail), and vite dev server
```

### Testing
- **Pest PHP** framework with automatic `RefreshDatabase` for Feature tests
- Tests in `tests/Feature/` use authenticated users: `$this->actingAs(User::factory()->create())`
- Run tests: `composer run test` (clears config cache first)

### Asset Building
- **Vite** handles CSS/JS compilation with Tailwind CSS v4
- Flux UI components are pre-compiled, CSS imported in `resources/css/app.css`
- Custom Tailwind theme with dark mode support using `@theme` directive

## Flux UI Integration

### CSS Architecture
```css
@import 'tailwindcss';
@import '../../vendor/livewire/flux/dist/flux.css';
@source '../views'; // Auto-scans Blade templates for classes
```

### Component Usage
- Flux components available as `<x-flux::button>` etc.
- Custom form styling with `[data-flux-field]` attributes
- Dark mode toggle via `.dark` class with custom CSS properties

## File Organization Tips

### When adding new features:
- **Authentication**: Extend `app/Livewire/Auth/` components
- **User settings**: Add to `app/Livewire/Settings/`
- **Tests**: Feature tests for full workflows, Unit tests for isolated logic
- **Views**: Blade components in `resources/views/components/`

### Database changes:
- Migration files follow Laravel 11+ anonymous class pattern
- Always add corresponding factory methods for testing

### Configuration:
- Fortify features enabled/disabled in `config/fortify.php`
- Custom rate limiters defined in `FortifyServiceProvider`