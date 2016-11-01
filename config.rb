require 'compass/import-once/activate'
# Require any additional compass plugins here.
add_import_path 'bower_components/breakpoint-sass/stylesheets'

# Set this to the root of your project when deployed:
http_path = "/"
css_dir = "build/assets/css/"
sass_dir = "source/assets/scss/"
images_dir = "source/assets/images/"
fonts_dir = "source/assets/font/"

output_style = :nested
environment = :production

# To enable relative paths to assets via compass helper functions. Uncomment:
# relative_assets = true

# To disable debugging comments that display the original location of your selectors. Uncomment:
# line_comments = false
color_output = false

preferred_syntax = :scss
