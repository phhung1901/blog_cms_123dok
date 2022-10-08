<?php
//
//
//namespace App\Models\Castables;
//
//use App\Libs\DiskPathTools\DiskPathInfo;
//use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
//use Illuminate\Database\Eloquent\Model;
//
//class FileInformation implements CastsAttributes
//{
//
//    /**
//     * @param Model $model
//     * @param string $key
//     * @param mixed $value
//     * @param array $attributes
//     *
//     * @return DiskPathInfo|null
//     */
//    public function get($model, string $key, $value, array $attributes)
//    {
//        if (!$value) return null;
//        return DiskPathInfo::parse($value);
//    }
//
//    /**
//     * @param Model $model
//     * @param string $key
//     * @param mixed $value
//     * @param array $attributes
//     *
//     * @return string|null
//     * @throws \Exception
//     */
//    public function set($model, string $key, $value, array $attributes)
//    {
//        if (empty($value)) return null;
//
//        if ($value instanceof DiskPathInfo) {
//            return $value->__toString();
//        }
//
//        if (is_string($value)) {
//            return DiskPathInfo::parse($value)->__toString();
//        }
//        throw new \Exception("Value of $key must instanceof ".DiskPathInfo::class);
//    }
//
//    /**
//     * Get the serialized representation of the value.
//     *
//     * @param Model $model
//     * @param  string  $key
//     * @param  mixed  $value
//     * @param  array  $attributes
//     * @return mixed
//     */
//    public function serialize($model, string $key, $value, array $attributes)
//    {
//        return (string) $value;
//    }
//}