# Moodle Local Plugin Example
Run these commands to change plugin name:
`find . -type f -iname '*.php' -exec sed -i '' 's/mylocalplugin/{newpluginname}/g' {} \;`
`find . -type f -iname '*.php' -exec sed -i '' 's/My local plugin/New plugin name/g' {} \;`
`find . -type f -iname '*.php' -exec sed -i '' 's/My Local Plugin/New Plugin Name/g' {} \;`
