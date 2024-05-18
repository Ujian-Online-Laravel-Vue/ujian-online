<script setup>
import { useEditor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import Underline from '@tiptap/extension-underline'
import TextAlign from '@tiptap/extension-text-align'
import Image from '@tiptap/extension-image'
import 'bootstrap-icons/font/bootstrap-icons.css'
import { ref } from 'vue'

const props = defineProps({
  modelValue: String,
})

const emit = defineEmits(['update:modelValue'])

const editor = ref(useEditor({
  content: props.modelValue,
  onUpdate: ({ editor }) => {
    emit('update:modelValue', editor.getHTML())
  },
  extensions: [
        StarterKit,
        Underline,
        Image.configure({
            inline: true,
            allowBase64: true,
        }),
        TextAlign.configure({
          types: ['heading', 'paragraph'],
        }),
    ],
  editorProps: {
    attributes: {
      class:
        'border border-gray-400 p-3 min-vh-25 max-vh-25 overflow-auto outline-none w-100 text-wrap',
    },
  },
}))

const uploadImage = () => {
  const input = document.createElement('input');
  input.type = 'file';
  input.accept = 'image/*';
  input.onchange = () => {
    const file = input.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = () => {
        editor.value.chain().focus().setImage({ src: reader.result }).run();
      };
      reader.readAsDataURL(file);
    }
  };
  input.click();
}

</script>

<template>
  <div class="container">
    <section v-if="editor" class="buttons border border-gray-400 d-flex justify-content-center align-items-center gap-2 border-top p-1 overflow-auto ">
      <button type="button" @click="editor.chain().focus().toggleBold().run()" :class="{ 'active bg-light': editor.isActive('bold') }" class="btn btn-light p-1">
        <i class="bi bi-type-bold font-medium" title="bold"></i>
      </button>
      <button type="button" @click="editor.chain().focus().toggleItalic().run()" :class="{ 'active bg-light': editor.isActive('italic') }" class="btn btn-light p-1">
        <i class="bi bi-type-italic font-medium"></i>
      </button>
      <button type="button" @click="editor.chain().focus().toggleUnderline().run()" :class="{ 'active bg-light': editor.isActive('underline') }" class="btn btn-light p-1">
        <i class="bi bi-type-underline font-medium"></i>
      </button>
      <button type="button" @click="editor.chain().focus().toggleStrike().run()" :class="{ 'active bg-light': editor.isActive('strike') }" class="btn btn-light p-1">
        <i class="bi bi-type-strikethrough font-medium"></i>
      </button>
      <button type="button" @click="editor.chain().focus().setTextAlign('left').run()" :class="{ 'active bg-light': editor.isActive({ textAlign: 'left' }) }" class="btn btn-light p-1">
        <i class="bi bi-text-left font-medium"></i>
      </button>
      <button type="button" @click="editor.chain().focus().setTextAlign('center').run()" :class="{ 'active bg-light': editor.isActive({ textAlign: 'center' }) }" class="btn btn-light p-1">
        <i class="bi bi-text-center font-medium"></i>
      </button>
      <button type="button" @click="editor.chain().focus().setTextAlign('right').run()" :class="{ 'active bg-light': editor.isActive({ textAlign: 'right' }) }" class="btn btn-light p-1">
        <i class="bi bi-text-right font-medium"></i>
      </button>
      <button type="button" @click="editor.chain().focus().setTextAlign('justify').run()" :class="{ 'active bg-light': editor.isActive({ textAlign: 'justify' }) }" class="btn btn-light p-1">
        <i class="bi bi-justify font-medium"></i>
      </button>
      <button type="button" @click="uploadImage" class="btn btn-light p-1">
        <i class="bi bi-card-image font-medium"></i>
      </button>
      <button type="button" @click="editor.chain().focus().toggleHeading({ level: 1 }).run()" :class="{ 'active bg-light': editor.isActive('heading', { level: 1 }) }" class="btn btn-light p-1">
        <i class="bi bi-type-h1 font-medium"></i>
      </button>
      <button type="button" @click="editor.chain().focus().toggleHeading({ level: 2 }).run()" :class="{ 'active bg-light': editor.isActive('heading', { level: 2 }) }" class="btn btn-light p-1">
        <i class="bi bi-type-h2 font-medium"></i>
      </button>
      <button type="button" @click="editor.chain().focus().toggleBulletList().run()" :class="{ 'active bg-light': editor.isActive('bulletList') }" class="btn btn-light p-1">
        <i class="bi bi-list-ul font-medium"></i>
      </button>
      <button type="button" @click="editor.chain().focus().toggleOrderedList().run()" :class="{ 'active bg-light': editor.isActive('orderedList') }" class="btn btn-light p-1">
        <i class="bi bi-list-ol font-medium"></i>
      </button>
      <button type="button" @click="editor.chain().focus().toggleBlockquote().run()" :class="{ 'active bg-light': editor.isActive('blockquote') }" class="btn btn-light p-1">
        <i class="bi bi-blockquote-left font-medium"></i>
      </button>
      <button type="button" @click="editor.chain().focus().toggleCode().run()" :class="{ 'active bg-light': editor.isActive('code') }" class="btn btn-light p-1">
        <i class="bi bi-code font-medium"></i>
      </button>
      <button type="button" @click="editor.chain().focus().setHorizontalRule().run()" class="btn btn-light p-1">
        <i class="bi bi-hr font-medium"></i>
      </button>
      <button type="button" class="btn btn-light p-1 enabled:text-secondary" @click="editor.chain().focus().undo().run()" :disabled="!editor.can().chain().focus().undo().run()">
        <i class="bi bi-arrow-counterclockwise font-medium"></i>
      </button>
      <button type="button" @click="editor.chain().focus().redo().run()" :disabled="!editor.can().chain().focus().redo().run()" class="btn btn-light p-1 enabled:text-secondary">
        <i class="bi bi-arrow-clockwise font-medium"></i>
      </button>
    </section>
    <EditorContent :editor="editor" class="tiptap" />
  </div>
</template>

<style scoped>
/* Responsive adjustments */
@media (max-width: 768px) {
  .buttons {
    flex-direction: column;
    gap: 0.5rem;
  }

  .btn {
    width: 100%;
  }
}

/* Basic editor styles */
.tiptap {
  margin: 1rem 0;
  > * + * {
    margin-top: 0.75em;
  }
  ul,
  ol {
    padding: 0 1rem;
  }
  h1,
  h2,
  h3,
  h4,
  h5,
  h6 {
    line-height: 1.1;
  }
  code {
    background-color: rgba(#616161, 0.1);
    color: #616161;
  }
  pre {
    background: #0D0D0D;
    color: #FFF;
    font-family: 'JetBrainsMono', monospace;
    padding: 0.75rem 1rem;
    border-radius: 0.5rem;
    code {
      color: inherit;
      padding: 0;
      background: none;
      font-size: 0.8rem;
    }
  }
  img {
    max-width: 100%;
    height: auto;
  }
  blockquote {
    padding-left: 1rem;
    border-left: 2px solid rgba(#0D0D0D, 0.1);
  }
  hr {
    border: none;
    border-top: 2px solid rgba(#0D0D0D, 0.1);
    margin: 2rem 0;
  }
}

/* Table-specific styling */
.tiptap {
  table {
    border-collapse: collapse;
    table-layout: fixed;
    width: 100%;
    margin: 0;
    overflow: hidden;
    td,
    th {
      min-width: 1em;
      border: 2px solid #ced4da;
      padding: 3px 5px;
      vertical-align: top;
      box-sizing: border-box;
      position: relative;
      > * {
        margin-bottom: 0;
      }
    }
    th {
      font-weight: bold;
      text-align: left;
      background-color: #f1f3f5;
    }
    .selectedCell:after {
      z-index: 2;
      position: absolute;
      content: "";
      left: 0;
      right: 0;
      top: 0;
      bottom: 0;
      background: rgba(200, 200, 255, 0.4);
      pointer-events: none;
    }
    .column-resize-handle {
      position: absolute;
      right: -2px;
      top: 0;
      bottom: -2px;
      width: 4px;
      background-color: #adf;
      pointer-events: none;
    }
    p {
      margin: 0;
    }
  }
}

.tableWrapper {
  overflow-x: auto;
}

.resize-cursor {
  cursor: ew-resize;
  cursor: col-resize;
}
</style>
