const TInput = {
    classes: "border-2 block w-full rounded text-gray-800",
    // Optional variants
    variants: {
        // ...
    }
    // Optional fixedClasses
    // fixedClasses: '',
};

const TTable = {
    classes: {
        table: "shadow min-w-full divide-y divide-gray-200",
        thead: "",
        theadTr: "",
        theadTh:
            "px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-700 uppercase tracking-wider",
        tbody: "bg-white divide-y divide-gray-200",
        tr: "",
        td: "px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-700",
        tfoot: "",
        tfootTr: "",
        tfootTd: ""
    },
    variants: {
        thin: {
            td: "p-1 whitespace-no-wrap text-sm leading-4 text-gray-700",
            theadTh:
                "p-1 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-700 uppercase tracking-wider"
        }
    }
};

const TButton = {
    classes: "rounded-lg border block inline-flex items-center justify-center",
    variants: {
        secondary:
            "rounded-lg border px-2 block inline-flex items-center justify-center bg-purple-500 border-purple-500 hover:bg-purple-600 hover:border-purple-600"
    }
    // Optional fixedClasses
    // fixedClasses: 'transform ease-in-out duration-100',
};

const settings = {
    TTable,
    TInput,
    TButton
};

export default settings;
