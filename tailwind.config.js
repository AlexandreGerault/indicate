module.exports = {
    theme: {
        translate: {
            '1/2': '50%',
            'full': '100%',
            'right-up': ['100%', '-100%'],
            '3d': ['40px', '-60px', '-130px'],
        },
        extend: {
            shadow: {

            },
            colors: {
                blue: {
                    50: "#DCEEFB",
                    100: "#B6E0FE",
                    200: "#84C5F4",
                    300: "#62B0E8",
                    400: "#4098D7",
                    500: "#2680C2",
                    600: "#186FAF",
                    700: "#0F609B",
                    800: "#0A558C",
                    900: "#003E6B",
                },
                grey: {
                    50: "#F5F7FA",
                    100: "#E4E7EB",
                    200: "#CBD2D9",
                    300: "#9AA5B1",
                    400: "#7B8794",
                    500: "#616E7C",
                    600: "#52606D",
                    700: "#3E4C59",
                    800: "#323F4B",
                    900: "#1F2933",
                },
                yellow: {
                    50: "#FFFBEA",
                    100: "#FFF3C4",
                    200: "#FCE588",
                    300: "#FADB5F",
                    400: "#F7C948",
                    500: "#F0B429",
                    600: "#DE911D",
                    700: "#CB6E17",
                    800: "#B44D12",
                    900: "#8D2B0B",
                },
            }
        }
    },
    variants: {},
    plugins: [
        require('tailwindcss-transforms')({
            '3d': false,
        }),
    ]
}
