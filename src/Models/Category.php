<?php

namespace Firefly\FilamentBlog\Models;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Firefly\FilamentBlog\Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Filament\Forms\Components\Select;
use Firefly\FilamentBlog\Models\CategoryGroup;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'group_id',
        'description'
    ];

    protected $casts = [
        'id' => 'integer',
    ];

    // Relationship with category group
    public function group(): BelongsTo
    {
        return $this->belongsTo(CategoryGroup::class, 'group_id');
    }

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, config('filamentblog.tables.prefix').'category_'.config('filamentblog.tables.prefix').'post');
    }

    public static function getForm()
    {
        return [
            TextInput::make('name')
                ->live(true)
                ->afterStateUpdated(function (Get $get, Set $set, ?string $operation, ?string $old, ?string $state) {

                    $set('slug', Str::slug($state));
                })
                ->unique(config('filamentblog.tables.prefix').'categories', 'name', null, 'id')
                ->required()
                ->maxLength(155),

            TextInput::make('slug')
                ->unique(config('filamentblog.tables.prefix').'categories', 'slug', null, 'id')
                ->readOnly()
                ->maxLength(255),
            TextInput::make('description')
                ->maxLength(1000),
            // add category group relationship
            Select::make('group_id')
                ->relationship('group', 'name')
                ->nullable(false)
                ->required(),
        ];
    }

    protected static function newFactory()
    {
        return new CategoryFactory();
    }

    public function getTable()
    {
        return config('filamentblog.tables.prefix') . 'categories';
    }
}
