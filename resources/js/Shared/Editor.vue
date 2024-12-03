<template>
    <div
        class="border form-control"
        :id="id"
        :class="['ql-container ql-bubble fs-3', $store.state.isNightMode ? 'bg-dark' : 'bg-light']">
    </div>
</template>

<script>
import Quill from 'quill';
import 'quill/dist/quill.bubble.css';
import { Delta } from "quill/core.js";

const SpanBlot = Quill.import('blots/inline');

class CustomBlot extends SpanBlot {
    static create(value) {
        let node = super.create();
        node.setAttribute('class', value);
        return node;
    }

    static formats(node) {
        return node.getAttribute('class');
    }
}

CustomBlot.blotName = 'customSpan';
CustomBlot.tagName = 'span';
Quill.register(CustomBlot);

export default {
    name: 'QuillEditor',
    data() {
        return {
            quill: null,
            container: null,
            toolbar: null
        };
    },
    props: {
        id: {
            type: String,
            required: true,
            default: 'editor',
        },
        disableToolbar: {
            type: Boolean,
            required: false,
            default: false,
        },
        modelValue: {
            type: String,
            required: false,
            default: '',
        }
    },
    mounted() {
        this.container = document.getElementById(this.id);

        if (this.disableToolbar) {
            this.toolbar = false;
        } else {
            this.toolbar = [
                ['bold', 'italic', 'underline'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                [{ 'header': [1, 2, false] }],
            ];
        }

        const quill = new Quill(this.container, {
            theme: 'bubble',
            modules: {
                toolbar: this.toolbar,
            },
        });

        this.quill = quill;

        // Set initial content from modelValue
        if (this.modelValue) {
            this.quill.root.innerHTML = this.modelValue;
        }

        quill.on('text-change', (delta, oldDelta, source) => {
            if (source === 'user') {
                let text = quill.getText();
                let currentPosition = 0;
                let words = text.split(/(\s+)/);

                words.forEach((word) => {
                    if (word.startsWith('#')) {
                        let index = text.indexOf(word, currentPosition);
                        quill.formatText(index, word.length, 'customSpan', 'badge hashtag');
                    } else if (word.startsWith('@')) {
                        let index = text.indexOf(word, currentPosition);
                        quill.formatText(index, word.length, 'customSpan', 'badge mention');
                    } else {
                        let index = text.indexOf(word, currentPosition);
                        quill.formatText(index, word.length, 'customSpan', false);
                    }

                    currentPosition += word.length;
                });

                const content = this.quill.root.innerHTML;
                const hashtags = quill.getText().match(/#\w+/g)?.map(word => word.substring(1)) || [];
                const mentions = quill.getText().match(/@\w+/g)?.map(word => word.substring(1)) || [];

                // Emit the content for v-model
                this.$emit('update:modelValue', content);

                // Emit custom input event for existing functionality
                this.$emit('input', {
                    hashtags,
                    mentions,
                    content
                });
            }
        });
    },
    watch: {
        modelValue(newValue) {
            if (newValue !== this.quill.root.innerHTML) {
                this.quill.root.innerHTML = newValue;
            }
        }
    },
    methods: {
        resetEditor() {
            this.quill.root.innerHTML = '';
            this.$emit('update:modelValue', '');
        },
        setContent(content) {
            this.quill.root.innerHTML = content;
            this.$emit('update:modelValue', content);
        },
    },
};
</script>
