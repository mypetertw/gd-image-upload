# gd-image-upload
### Php script to upload your image and compress via PHP GD library.

---

## Getting Started

Put `Compress.php` to your project.

## Usage

```php
$IMG_FIELD_NAME = 'icon';
$IMG_NAME = 'abc';
$IMG_LOCATION = 'images/media/';
$IMG_TARGET_LOCATION = 'images/media/icon/';
$IMG_WIDTH_LIMIT = 1920;

$ORIGINAL = UPLOAD($IMG_FIELD_NAME, $IMG_NAME, $IMG_LOCATION);
$ICON = COMPRESS($IMG_FIELD_NAME, $IMG_NAME, $IMG_TARGET_LOCATION, $IMG_LOCATION, $IMG_WIDTH_LIMIT);
```

## Tips

- If your image is larger than `$IMG_WIDTH_LIMIT`, you will start using the GD library to compress your image.
- `$ORIGINAL` is the original size image and can be used directly.
- The width of the image will be compressed according to your `$IMG_WIDTH_LIMIT`.
