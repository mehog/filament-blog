<?php

namespace Firefly\FilamentBlog;

use Firefly\FilamentBlog\Components\Card;
use Firefly\FilamentBlog\Components\Comment;
use Firefly\FilamentBlog\Components\FeatureCard;
use Firefly\FilamentBlog\Components\Header;
use Firefly\FilamentBlog\Components\HeaderCategory;
use Firefly\FilamentBlog\Components\Layout;
use Firefly\FilamentBlog\Components\RecentPost;
use Firefly\FilamentBlog\Console\Commands\RenameTablesCommand;
use Illuminate\Config\Repository as Config;
use Illuminate\Support\Facades\Route;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentBlogServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('filament-blog')
            ->hasConfigFile(['filamentblog'])
            ->hasMigrations('create_blog_tables')
            ->hasMigrations('create_blog_category_tables')
            ->hasCommands(RenameTablesCommand::class)
            ->runsMigrations()
            ->hasViewComponents(
                'blog',
                Layout::class,
                RecentPost::class,
                Header::class,
                Comment::class,
                HeaderCategory::class,
                FeatureCard::class,
                Card::class
            )
            ->hasViews('filament-blog')
            ->hasRoute('web')
            ->hasInstallCommand(function (InstallCommand $installCommand) {
                $installCommand
                    ->startWith(function (InstallCommand $command) {
                        $command->info('Hello, and welcome to my great new package!');
                        $command->newLine(1);
                    })
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->endWith(function (InstallCommand $installCommand) {
                        $installCommand->newLine(1);
                        $installCommand->info('========================================================================================================');
                        $installCommand->info("Get ready to breathe easy! Our package has just saved you from a day's worth of headaches and hassle.");
                        $installCommand->info('========================================================================================================');

                    });
            });
        //        $this->loadTestingMigration();
    }

    public function register()
    {
        Route::bind('post', function ($value) {
            return \Firefly\FilamentBlog\Models\Post::where('slug', $value)->published()->firstOrFail();
        });

        $this->app->register(EventServiceProvider::class);

        $this->app->singleton('seometa', function ($app) {
            return new SEOMeta(new Config($app->config->get('filamentblog.seo.meta')));
        });

        return parent::register(); // TODO: Change the autogenerated stub
    }

    public function loadTestingMigration(): void
    {
        if ($this->app->environment('testing')) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        }
    }
}
