import type { RollupOptions } from 'rollup'
import typescript from '@rollup/plugin-typescript'
import terser from '@rollup/plugin-terser'
import { nodeResolve } from '@rollup/plugin-node-resolve'

export default {
	input: 'source.ts',
	output: { file: 'bundle.js', format: 'iife' },
	plugins: [
		nodeResolve(),
		typescript(),
		terser(),
	],
} satisfies RollupOptions
