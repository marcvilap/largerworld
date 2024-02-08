import type { Config } from "tailwindcss";

export default {
	future: {
		disableColorOpacityUtilitiesByDefault: true,
	},
	content: ["./*.php", "./source.ts"],
	theme: {
		screens: {
			sm: "28rem",
			md: "48rem",
			lg: "64rem",
			xl: "80rem",
		},
		container: {
			center: true,
			padding: {
				DEFAULT: "2rem",
				xl: "5rem",
			},
		},
		extend: {
			fontFamily: {
				sans: "'Gordita', sans-serif",
				sf: "'SF Hello', sans-serif",
			},
			colors: {
				violet: {
					700: "#7323F4",
				},
				orange: {
					500: "#FA6400",
				},
			},
			animation: {
				spin: "spin 4s linear infinite",
			},
		},
	},
} satisfies Config;
