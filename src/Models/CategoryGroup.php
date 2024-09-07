<?php
namespace Firefly\FilamentBlog\Models;

use Illuminate\Database\Eloquent\Model;
use Firefly\FilamentBlog\Database\Factories\CategoryGroupFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Filament\Forms\Components\TextInput;

class CategoryGroup extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function getForm()
    {
        return [
            TextInput::make('name')
                ->unique(config('filamentblog.tables.prefix').'category_groups', 'name', null, 'id')
                ->required()
                ->maxLength(155)
        ];
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'group_id');
    }

    protected static function newFactory()
    {
        return new CategoryGroupFactory();
    }

    public function getTable()
    {
        return config('filamentblog.tables.prefix') . 'category_groups';
    }
}
