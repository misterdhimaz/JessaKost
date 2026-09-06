<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('tenant.guests.index') }}" class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center text-gray-500 hover:bg-gray-200 transition-colors">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="font-extrabold text-xl text-gray-900 leading-tight">Lapor Tamu Baru</h2>
                <p class="text-sm text-gray-400 font-medium">Wajib lapor untuk keamanan bersama</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h3 class="font-extrabold text-gray-900 text-lg">Form Buku Tamu</h3>
            </div>

            <div class="p-8">
                <form action="{{ route('tenant.guests.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label for="visitor_name" class="block font-bold text-gray-900 text-sm mb-2">Nama Lengkap Tamu</label>
                        <input type="text" name="visitor_name" id="visitor_name" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon block p-3 font-medium transition-colors" required>
                    </div>

                    <div>
                        <label for="visit_date" class="block font-bold text-gray-900 text-sm mb-2">Tanggal Kunjungan</label>
                        <input type="date" name="visit_date" id="visit_date" value="{{ date('Y-m-d') }}" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon block p-3 font-medium transition-colors" required>
                    </div>

                    <div>
                        <label for="purpose" class="block font-bold text-gray-900 text-sm mb-2">Keperluan</label>
                        <input type="text" name="purpose" id="purpose" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-jessa-maroon focus:border-jessa-maroon block p-3 font-medium transition-colors" placeholder="Misal: Kerja kelompok / Menginap sementara" required>
                    </div>

                    <div>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_overnight" id="is_overnight" value="1" class="w-5 h-5 text-jessa-maroon bg-gray-50 border-gray-300 rounded focus:ring-jessa-maroon focus:ring-2" onchange="toggleKTP(this)">
                            <span class="font-bold text-gray-900 text-sm">Tamu Menginap</span>
                        </label>
                        <p class="text-xs text-gray-400 mt-2 ml-8">Centang jika tamu akan menginap (bermalam).</p>
                    </div>

                    <div id="ktp_section" class="p-5 bg-orange-50 border border-orange-100 rounded-xl mt-4">
                        <label class="block font-bold text-orange-900 text-sm mb-2"><i class="fas fa-id-card mr-2"></i>Foto Kartu Pengenal (KTP / KTM / SIM)</label>
                        <p class="text-xs text-orange-700 mb-3">Opsional untuk kunjungan biasa. <span class="font-bold">Wajib disertakan</span> jika tamu menginap.</p>

                        {{-- Hidden input for base64 --}}
                        <input type="hidden" name="id_card_base64" id="id_card_base64">

                        <div class="space-y-4">
                            {{-- Option 1: File Upload --}}
                            <div>
                                <input type="file" name="id_card_photo" id="id_card_photo" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-100 file:text-orange-700 hover:file:bg-orange-200 transition-all cursor-pointer" accept="image/*" capture="environment">
                            </div>

                            <div class="flex items-center gap-4">
                                <hr class="flex-1 border-orange-200">
                                <span class="text-xs font-bold text-orange-400 uppercase">ATAU</span>
                                <hr class="flex-1 border-orange-200">
                            </div>

                            {{-- Option 2: Live Camera --}}
                            <div class="text-center">
                                <button type="button" id="btn_open_cam" onclick="startCamera()" class="bg-orange-100 text-orange-700 hover:bg-orange-200 font-bold px-4 py-2 rounded-xl text-sm transition-colors border border-orange-200 w-full sm:w-auto">
                                    <i class="fas fa-camera mr-2"></i> Buka Kamera Web/Laptop
                                </button>
                            </div>

                            {{-- Camera Container --}}
                            <div id="camera_container" class="hidden flex-col items-center gap-3">
                                <div class="relative w-full max-w-sm rounded-xl overflow-hidden border-2 border-orange-200 bg-black aspect-video flex justify-center items-center">
                                    <video id="camera_video" class="w-full h-full object-cover" autoplay playsinline></video>
                                    <canvas id="camera_canvas" class="hidden w-full h-full object-cover"></canvas>
                                </div>
                                <div class="flex gap-2">
                                    <button type="button" id="btn_capture" onclick="takeSnapshot()" class="bg-jessa-maroon text-white font-bold px-4 py-2 rounded-xl text-sm shadow hover:bg-jessa-maroonDark transition-colors">
                                        <i class="fas fa-camera-retro mr-2"></i> Jepret Foto
                                    </button>
                                    <button type="button" id="btn_retake" onclick="retakePhoto()" class="hidden bg-gray-500 text-white font-bold px-4 py-2 rounded-xl text-sm shadow hover:bg-gray-600 transition-colors">
                                        <i class="fas fa-undo mr-2"></i> Ulangi
                                    </button>
                                    <button type="button" onclick="stopCamera()" class="bg-gray-200 text-gray-700 font-bold px-4 py-2 rounded-xl text-sm hover:bg-gray-300 transition-colors">
                                        Tutup
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100">
                        <a href="{{ route('tenant.guests.index') }}" class="text-gray-500 bg-gray-100 hover:bg-gray-200 font-bold rounded-xl text-sm px-6 py-3 transition-colors">
                            Batal
                        </a>
                        <button type="submit" class="text-white bg-jessa-maroon hover:bg-jessa-maroonDark font-bold rounded-xl text-sm px-6 py-3 transition-all shadow-sm">
                            <i class="fas fa-save mr-2"></i> Laporkan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Checkbox logic
        function toggleKTP(checkbox) {
            const ktpInput = document.getElementById('id_card_photo');
            const ktpBase64 = document.getElementById('id_card_base64');
            if (checkbox.checked) {
                // Require at least one option if overnight
                if(!ktpBase64.value) ktpInput.setAttribute('required', 'required');
            } else {
                ktpInput.removeAttribute('required');
            }
        }

        // Live Camera Logic
        let videoStream = null;
        const video = document.getElementById('camera_video');
        const canvas = document.getElementById('camera_canvas');
        const btnOpen = document.getElementById('btn_open_cam');
        const container = document.getElementById('camera_container');
        const btnCapture = document.getElementById('btn_capture');
        const btnRetake = document.getElementById('btn_retake');
        const base64Input = document.getElementById('id_card_base64');
        const fileInput = document.getElementById('id_card_photo');

        async function startCamera() {
            try {
                videoStream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' }, audio: false });
                video.srcObject = videoStream;
                container.classList.remove('hidden');
                container.classList.add('flex');
                btnOpen.classList.add('hidden');

                // Reset states
                video.classList.remove('hidden');
                canvas.classList.add('hidden');
                btnCapture.classList.remove('hidden');
                btnRetake.classList.add('hidden');
            } catch (err) {
                alert("Tidak dapat mengakses kamera. Pastikan browser memiliki izin akses kamera.");
                console.error(err);
            }
        }

        function stopCamera() {
            if (videoStream) {
                videoStream.getTracks().forEach(track => track.stop());
            }
            container.classList.add('hidden');
            container.classList.remove('flex');
            btnOpen.classList.remove('hidden');
        }

        function takeSnapshot() {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);

            const dataUrl = canvas.toDataURL('image/jpeg');
            base64Input.value = dataUrl;

            // Remove required from file input since we have a snapshot
            fileInput.removeAttribute('required');
            // Clear file input just in case
            fileInput.value = '';

            video.classList.add('hidden');
            canvas.classList.remove('hidden');
            btnCapture.classList.add('hidden');
            btnRetake.classList.remove('hidden');
        }

        function retakePhoto() {
            base64Input.value = '';
            video.classList.remove('hidden');
            canvas.classList.add('hidden');
            btnCapture.classList.remove('hidden');
            btnRetake.classList.add('hidden');

            // Re-apply required if overnight checked
            if(document.getElementById('is_overnight').checked) {
                fileInput.setAttribute('required', 'required');
            }
        }

        // Clear base64 if user selects a file instead
        fileInput.addEventListener('change', function() {
            if(this.files.length > 0) {
                base64Input.value = '';
                if(videoStream) stopCamera();
            }
        });
    </script>
</x-app-layout>

