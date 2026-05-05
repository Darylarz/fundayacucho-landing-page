@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0"><i class="bi bi-mortarboard-fill me-2"></i>Formulario de Postulación a Becas</h2>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted mb-4">Completa el siguiente formulario para postular a nuestros programas de becas. Todos los campos marcados con (*) son obligatorios.</p>
                    
                    <form>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombres" class="form-label">Nombres *</label>
                                <input type="text" class="form-control" id="nombres" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="apellidos" class="form-label">Apellidos *</label>
                                <input type="text" class="form-control" id="apellidos" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Correo Electrónico *</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telefono" class="form-label">Teléfono *</label>
                                <input type="tel" class="form-control" id="telefono" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cedula" class="form-label">Cédula de Identidad *</label>
                                <input type="text" class="form-control" id="cedula" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento *</label>
                                <input type="date" class="form-control" id="fecha_nacimiento" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección de Habitación *</label>
                            <textarea class="form-control" id="direccion" rows="3" required></textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nivel_estudios" class="form-label">Nivel de Estudios Actual *</label>
                                <select class="form-select" id="nivel_estudios" required>
                                    <option value="">Selecciona...</option>
                                    <option value="bachiller">Bachiller</option>
                                    <option value="tsu">TSU</option>
                                    <option value="licenciatura">Licenciatura</option>
                                    <option value="maestria">Maestría</option>
                                    <option value="doctorado">Doctorado</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tipo_beca" class="form-label">Tipo de Beca Deseada *</label>
                                <select class="form-select" id="tipo_beca" required>
                                    <option value="">Selecciona...</option>
                                    <option value="nacional">Beca Nacional</option>
                                    <option value="internacional">Beca Internacional</option>
                                    <option value="investigacion">Beca de Investigación</option>
                                    <option value="posgrado">Beca de Posgrado</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="institucion" class="form-label">Institución de Estudios Actual *</label>
                            <input type="text" class="form-control" id="institucion" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="promedio" class="form-label">Promedio Académico *</label>
                            <input type="number" class="form-control" id="promedio" step="0.01" min="0" max="20" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="motivacion" class="form-label">Carta de Motivación *</label>
                            <textarea class="form-control" id="motivacion" rows="5" required 
                                placeholder="Explica por qué mereces esta beca y cuáles son tus metas académicas y profesionales..."></textarea>
                        </div>
                        
                        <div class="mb-4">
                            <label for="documento" class="form-label">Adjuntar Documentos</label>
                            <input type="file" class="form-control" id="documento" multiple accept=".pdf,.doc,.docx">
                            <small class="text-muted">Adjunta tu currículum, certificados académicos y otros documentos relevantes (máximo 5MB en total)</small>
                        </div>
                        
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="terminos" required>
                            <label class="form-check-label" for="terminos">
                                Acepto los términos y condiciones del programa de becas de la Fundación Gran Mariscal de Ayacucho *
                            </label>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-send-fill me-2"></i>
                                Enviar Postulación
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
