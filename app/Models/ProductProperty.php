<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductProperty
 *
 * @property int $id
 * @property string $piki-url
 * @property string $name
 * @property string|null $description
 * @property int|null $parent_id
 * @property int $image_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProperty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProperty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProperty query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProperty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProperty whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProperty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProperty whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProperty whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProperty whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProperty wherePikiUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProperty whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $piki_url
 * @property string|null $img_url
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProperty whereImgUrl($value)
 */
class ProductProperty extends Model
{

    protected $table = "categories";

    protected $fillable = [
        'name',
        'text',
        'product_id',
    ];

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int|null
     */
    public function getParentId(): ?int
    {
        return $this->parent_id;
    }

    /**
     * @param int|null $parent_id
     */
    public function setParentId(?int $parent_id): void
    {
        $this->parent_id = $parent_id;
    }

    /**
     * @return int
     */
    public function getImageId(): int
    {
        return $this->image_id;
    }

    /**
     * @param int $image_id
     */
    public function setImageId(int $image_id): void
    {
        $this->image_id = $image_id;
    }

    /**
     * @return string
     */
    public function getPikiUrl(): string
    {
        return $this->piki_url;
    }

    /**
     * @param string $piki_url
     */
    public function setPikiUrl(string $piki_url): void
    {
        $this->piki_url = $piki_url;
    }


}
