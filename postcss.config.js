/** @type {import('postcss-load-config').Config} */
export default {
	plugins: {
		'postcss-import': {},
		tailwindcss: {},
		autoprefixer: {},
		cssnano: {
			preset: [
				'default',
				{
					discardComments: {
						removeAll: true,
					},
				},
			],
		},
	},
}
